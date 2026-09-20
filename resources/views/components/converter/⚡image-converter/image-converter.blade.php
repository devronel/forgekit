<div x-data="converter()">
    <div class="mx-auto my-12 max-w-2xl">
        <div class="overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5">
            <div class="p-6 sm:p-8">
                <div
                    @dragover.prevent="dragOver = true"
                    @dragleave.prevent="dragOver = false"
                    @drop.prevent="handleDrop($event)"
                    @keydown.enter.prevent="document.getElementById('fileConverted').click()"
                    @keydown.space.prevent="document.getElementById('fileConverted').click()"
                    role="button"
                    tabindex="0"
                    aria-label="Upload images. Click or drag and drop files here."
                    :class="{
                        'relative flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed p-8 transition-all duration-200': true,
                        'border-indigo-300 bg-indigo-50/50': metadatas.length === 0 && !dragOver,
                        'border-indigo-400 bg-indigo-100/70': dragOver,
                        'border-emerald-300 bg-emerald-50/50': metadatas.length > 0 && !dragOver,
                    }"
                >
                    <div @click="document.getElementById('fileConverted').click()" class="flex flex-col items-center gap-3">
                        <span class="flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100 text-indigo-600" aria-hidden="true">
                            <span class="icon-[mdi--file-image-outline] text-2xl"></span>
                        </span>
                        <div class="text-center">
                            <p class="text-sm font-medium text-slate-700">
                                <span class="text-indigo-600 underline underline-offset-2">Click to upload</span>
                                <span class="text-slate-500"> or drag and drop</span>
                            </p>
                            <p class="mt-1 text-xs text-slate-400">PNG, JPEG, JPG, WebP — up to 16 MB each</p>
                        </div>
                    </div>
                    <input id="fileConverted" type="file" accept=".jpeg,.jpg,.png,.webp" multiple @change="handleFileSelect($event)" class="hidden" aria-hidden="true" tabindex="-1">
                </div>

                {{-- List --}}
                @if (!empty($convertedFiles))
                    <div class="mt-6 space-y-3" aria-label="Converted files">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-emerald-600">
                                <span class="icon-[mdi--check-circle] mr-1 text-xs" aria-hidden="true"></span>
                                {{ count($convertedFiles) }} converted file{{ count($convertedFiles) !== 1 ? 's' : '' }}
                            </p>
                            <button wire:click='resetProperties()' class="cursor-pointer text-xs font-medium text-red-500 transition hover:text-red-600" aria-label="Remove all selected files">Reset</button>
                        </div>
                        @foreach ($convertedFiles as $index => $converted)
                            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                                <div class="flex items-start gap-4 p-4">
                                    @php
                                        $extension = pathinfo($converted["name"], PATHINFO_EXTENSION);
                                        $mime = $extension === 'jpg' || $extension === 'jpeg' ? 'jpeg' : $extension;
                                    @endphp
                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                        <img src="data:image/{{ $mime }};base64,{{ $converted["base64"] }}" alt="Preview of {{ $converted["name"] }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p title="{{ $converted["name"] }}" class="truncate text-sm font-medium text-slate-900">{{ $converted["name"] }}</p>
                                        <p class="mt-0.5 text-xs text-slate-500">{{ round(strlen(base64_decode($converted["base64"])) / 1024, 1) . ' KB' }}</p>
                                        <div class="mt-2">
                                            <button
                                                wire:click="download({{ $index }})"
                                                :aria-label="'Download {{ $converted["name"] }}'"
                                                class="cursor-pointer inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700"
                                            >
                                                <span class="icon-[mdi--download] text-sm" aria-hidden="true"></span>
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <template x-if="metadatas.length > 0">
                        <div class="mt-6">
                            <div class="mb-3 flex items-center justify-between">
                                <p class="text-xs font-medium text-slate-500">
                                    <span x-text="metadatas.length"></span> file<span x-show="metadatas.length !== 1">s</span> selected
                                </p>
                                <button @click="metadatas = []" class="text-xs font-medium text-red-500 transition hover:text-red-600" aria-label="Remove all selected files">Remove all</button>
                            </div>
                            <div class="space-y-2">
                                <template x-for="(entry, index) in metadatas" :key="entry.id">
                                    <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2.5">
                                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-indigo-100 text-indigo-600" aria-hidden="true">
                                            <span class="icon-[mdi--file-image-outline] text-sm"></span>
                                        </span>
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-medium text-slate-900" x-text="entry.name"></p>
                                            <p class="text-xs text-slate-400" x-text="formatSize(entry.size)"></p>
                                        </div>

                                        {{-- From format --}}
                                        <span class="flex shrink-0 items-center gap-1 rounded-md border border-slate-200 bg-slate-100 px-2 py-1 text-[11px] font-semibold uppercase text-slate-500" aria-label="Source format" x-text="entry.fromFormat">
                                        </span>

                                        <span class="text-slate-300" aria-hidden="true">
                                            <span class="icon-[mdi--arrow-right] text-lg"></span>
                                        </span>

                                        {{-- To format dropdown --}}
                                        <div class="relative shrink-0" x-data="{ open: false }" x-on:click.outside="open = false">
                                            <button
                                                x-on:click="open = !open"
                                                :aria-expanded="open"
                                                aria-haspopup="listbox"
                                                :aria-label="'Convert to format. Selected: ' + entry.toFormat.toUpperCase()"
                                                class="flex items-center gap-1.5 rounded-md border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-900 transition hover:border-slate-300"
                                            >
                                                <span x-text="entry.toFormat.toUpperCase()"></span>
                                                <span class="icon-[mdi--chevron-down] text-slate-400 text-[14px]" x-bind:class="{ 'rotate-180': open }" aria-hidden="true"></span>
                                            </button>
                                            <div
                                                x-show="open"
                                                x-cloak
                                                x-transition:enter="transition duration-100 ease-out"
                                                x-transition:enter-start="translate-y-0.5 opacity-0"
                                                x-transition:enter-end="translate-y-0 opacity-100"
                                                role="listbox"
                                                :aria-label="'Select format for ' + entry.name"
                                                class="absolute right-0 top-full z-20 mt-1 w-40 overflow-auto rounded-lg border border-slate-200 bg-white py-1 shadow-lg"
                                            >
                                                <template x-for="fmt in formats" :key="fmt.value">
                                                    <button
                                                        x-on:click="selectToFormat(index, fmt.value); open = false"
                                                        role="option"
                                                        :aria-selected="fmt.value === entry.toFormat"
                                                        class="flex w-full items-center gap-2 px-3 py-1.5 text-left text-xs transition hover:bg-slate-50"
                                                        x-bind:class="{ 'bg-indigo-50 text-indigo-700': fmt.value === entry.toFormat }"
                                                    >
                                                        <span class="flex h-5 w-5 items-center justify-center rounded bg-slate-100 text-[9px] font-bold uppercase text-slate-500" x-text="fmt.value"></span>
                                                        <span class="font-medium" x-text="fmt.label"></span>
                                                        <span x-show="fmt.value === entry.toFormat" class="ml-auto text-indigo-500" aria-hidden="true">
                                                            <span class="icon-[mdi--check-bold] text-[11px]"></span>
                                                        </span>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>

                                        {{-- Remove --}}
                                        <button @click="removeFile(index)" :aria-label="'Remove ' + entry.name" class="flex cursor-pointer h-7 w-7 shrink-0 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                                            <span class="icon-[mdi--close] text-sm" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                @endif

                {{-- Convert button --}}
                <div class="mt-6">
                    <button
                        :disabled="metadatas.length === 0 || isConverting"
                        :aria-busy="isConverting"
                        :aria-label="isConverted ? 'Conversion complete' : isConverting ? 'Converting images' : 'Convert images'"
                        @click="
                            isConverting = true;
                            $wire.forge().then(() => { isConverting = false; isConverted = true }).catch(() => { isConverting = false });
                        "
                        class="cursor-pointer flex w-full items-center justify-center gap-2.5 rounded-xl px-6 py-3.5 text-sm font-semibold text-white transition-all duration-200 disabled:cursor-not-allowed disabled:opacity-50"
                        :class="isConverting ? 'bg-indigo-500' : metadatas.length > 0 ? 'bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98]' : 'bg-slate-300'"
                    >
                        <span x-show="!isConverting && !isConverted" class="inline-flex items-center gap-2.5">
                            <span class="icon-[mdi--upload-outline] text-lg" aria-hidden="true"></span>
                            Convert <span x-show="metadatas.length > 0" x-text="'(' + metadatas.length + ')'"></span>
                        </span>
                        <span x-show="isConverting" class="inline-flex items-center gap-2.5">
                            <span class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white" aria-hidden="true"></span>
                            Converting...
                        </span>
                        <span x-show="isConverted && !isConverting" class="inline-flex items-center gap-2.5">
                            <span class="icon-[mdi--check-circle] text-lg" aria-hidden="true"></span>
                            Conversion Complete
                        </span>
                    </button>
                </div>

                {{-- Trust Bar --}}
                <div class="mt-5 flex items-center justify-center gap-6 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5">
                        <span class="icon-[mdi--lightning-bolt-outline] text-sm"></span>
                        Fast
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="icon-[mdi--memory] text-sm"></span>
                        Memory only
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('converter', () => ({

            metadatas: @entangle("metadatas"),
            dragOver: false,
            isConverting: false,
            isConverted: false,
            idCounter: 0,

            formats: [
                { value: 'png', label: 'PNG', desc: 'Lossless, transparency' },
                { value: 'jpg', label: 'JPG', desc: 'Lossy, small files' },
                { value: 'jpeg', label: 'JPEG', desc: 'Lossy, high quality' },
                { value: 'webp', label: 'WebP', desc: 'Modern, efficient' }
            ],

            formatSize(bytes) {
                if (!bytes) return ''
                if (bytes < 1024) return bytes + ' B'
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB'
                return (bytes / 1048576).toFixed(1) + ' MB'
            },
            
            handleFileSelect(event) {
                this.addFiles(event.target.files)
                event.target.value = ''
            },

            handleDrop(event) {
                this.dragOver = false
                this.addFiles(event.dataTransfer.files)
            },

            addFiles(files) {
                for (const file of files) {

                    if (!file.type.startsWith('image/')) continue

                    const extension = file.name.split('.').pop().toLowerCase()

                    const match = this.formats.find(format => format.value === extension)

                    let id = this.idCounter++
                    
                    this.metadatas.push({
                        id: id,
                        name: file.name,
                        size: file.size,
                        fromFormat: match ? extension : 'png',
                        toFormat: extension === 'png' ? 'jpg' : 'png',
                    })

                    this.$wire.upload(
                        `files.${id}`,
                        file,
                        (uploadedFilename) => {}
                    )
                }
                
                this.isConverted = false
            },

            removeFile(index) {
                this.metadatas.splice(index, 1)
                if (this.metadatas.length === 0) this.isConverted = false
            },

            selectToFormat(index, value) {
                this.metadatas[index].toFormat = value
                this.isConverted = false
            },

        }))
    </script>
@endscript