<?php

use App\Enums\ImageFormat;
use App\Services\ImageProcessingService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

new class extends Component
{
    use WithFileUploads;

    public array $files = [];
    public array $metadatas = [];
    public array $convertedFiles = [];

    // Convert image format
    public function forge(){

        try {

            // Validation
            $validFormats = array_map(fn($case) => $case->value, ImageFormat::cases());
    
            $rules = [
                'metadatas' => ['required', 'array', 'min:1'],
                'metadatas.*.id' => ['required', 'integer'],
                'metadatas.*.toFormat' => ['required', 'string', 'in:' . implode(',', $validFormats)],
            ];
    
            foreach ($this->metadatas ?? [] as $image) {
                $id = $image['id'] ?? null;
                $rules["files.$id"] = ['required', 'file', 'image', 'max:16384'];
            }
    
            $files = [];
            foreach ($this->metadatas ?? [] as $image) {
                $id = $image['id'] ?? null;
                if ($id !== null) {
                    $files[$id] = $this->files[$id] ?? null;
                }
            }
    
            $validated = Validator::make([
                'metadatas' => $this->metadatas,
                'files' => $files,
            ], $rules)->validate();

    
            foreach ($validated['metadatas'] as $key => $metadata) {
                $converted = app(ImageProcessingService::class)->convert($this->files[$metadata["id"]] , $metadata['toFormat']);
                $filename = $this->files[$metadata['id']]->getClientOriginalName();
                $name = pathinfo($filename, PATHINFO_FILENAME) . '-converted-' . now()->format('Ymd_His') . '.' . $metadata['toFormat'];
                $this->convertedFiles[] = ["name" => $name, "base64" => base64_encode($converted)];
            }
    
            $this->reset("images", "metadatas");

        } catch (\Throwable $th) {
            Log::error('Convertion Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine()
            ]);
        }
    }

    // Download converted file
    public function download(int $index): StreamedResponse
    {
        $item = $this->convertedFiles[$index] ?? null;

        if (!$item) {
            abort(404);
        }

        return response()->streamDownload(function () use ($item) {
            echo base64_decode($item['base64']);
        }, $item['name']);
    }

    // Reset properties
    public function resetProperties()
    {
        $this->reset('convertedFiles');
    }
};