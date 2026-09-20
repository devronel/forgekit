<div x-data="convertedPage()" class="min-h-screen bg-slate-50 font-sans">

    @section('title', 'Image Forge | Converter')

    @section('description', 'Convert images to JPG, PNG, or WebP instantly with Image Forge. Free online image converter — no uploads to disk, no sign-up, fully in-memory processing.')
    @section('keywords', 'image converter, convert image to JPG, convert image to PNG, convert image to WebP, free image converter, online image converter, image format converter')

    @section('og:title', 'Image Forge | Free Online Image Converter')
    @section('og:description', 'Convert images to JPG, PNG, or WebP instantly. Free, fast, and private — all processing stays in memory.')

    {{-- Hero Section --}}
    <section class="relative -mt-18.25 overflow-hidden bg-linear-to-br from-slate-900 via-indigo-950 to-slate-900 pt-18.25">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSA2MCAwIEwgMCAwIDAgNjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-40"></div>
        <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-violet-500/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 pb-20 pt-20 sm:px-6 sm:pb-28 sm:pt-28 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Convert your images
                    <span class="bg-linear-to-r from-amber-300 to-orange-400 bg-clip-text text-transparent">instantly</span>
                </h1>
                <p class="mt-4 text-lg leading-relaxed text-slate-300">
                    Drop any image and pick the format you need. Fast, secure, and right in your browser.
                </p>
            </div>

            {{-- Converter Card --}}
            <livewire:converter.image-converter />
            
        </div>
    </section>


    {{-- Stats Section --}}
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900 sm:text-3xl">4</p>
                    <p class="mt-1 text-xs font-medium text-slate-500">Formats Supported</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900 sm:text-3xl">99.9%</p>
                    <p class="mt-1 text-xs font-medium text-slate-500">Uptime</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900 sm:text-3xl">Free</p>
                    <p class="mt-1 text-xs font-medium text-slate-500">No hidden costs</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900 sm:text-3xl">100%</p>
                    <p class="mt-1 text-xs font-medium text-slate-500">In-Memory</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-white py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Why Image Forge?
                </h2>
                <p class="mt-3 text-base leading-relaxed text-slate-500">
                    Fast, secure, and simple image conversion. Convert your images in seconds with support for the most common web formats.
                </p>
            </div>

            <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--lightning-bolt-outline] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Fast Conversion
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Convert images quickly with an optimized processing pipeline designed for speed.
                    </p>
                </div>

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--shield-check-outline] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Secure Processing
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Files are processed in-memory with no disk storage to help protect your privacy.
                    </p>
                </div>

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--image-outline] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        High Quality Output
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Convert images while maintaining clear and reliable image quality.
                    </p>
                </div>

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--file-image-outline] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Popular Formats
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Easily convert between JPG, JPEG, PNG, and WebP image formats.
                    </p>
                </div>

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--responsive] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Works Everywhere
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Use Image Forge on desktop, tablet, or mobile with a responsive experience.
                    </p>
                </div>

                <div class="group rounded-xl border border-slate-200 bg-white p-6 transition hover:border-indigo-200 hover:shadow-md">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-200">
                        <span class="icon-[mdi--infinity] text-xl"></span>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Free to Use
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Convert as many images as you need without subscriptions or hidden limits.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Supported Formats Section --}}
    <section class="border-t border-slate-200 bg-slate-50 py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Supported Formats</h2>
                <p class="mt-3 text-base leading-relaxed text-slate-500">
                    Convert between the most common web image formats.
                </p>
            </div>
            <div class="mt-12">
                <template x-for="category in formatCategories" :key="category.name">
                    <div class="mb-8 last:mb-0">
                        <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-slate-400" x-text="category.name"></h3>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="fmt in category.formats" :key="fmt">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:border-indigo-200 hover:text-indigo-600"
                                    x-text="fmt"
                                ></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
</div>

@script
    <script>
        Alpine.data('convertedPage', () => ({
            formatCategories: [
                {
                    name: 'Raster Images',
                    formats: ['PNG', 'JPG', 'JPEG', 'WebP'],
                }
            ]
        }))
    </script>
@endscript
