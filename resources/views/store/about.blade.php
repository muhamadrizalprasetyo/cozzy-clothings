<x-app-layout>
    <div class="py-12 md:py-20 animate-fade-in">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-gray-900 uppercase mb-4">About COZZY<span class="text-indigo-600">.</span></h1>
                <p class="text-gray-500 font-medium text-lg">Crafting the standard of premium comfort since 2024.</p>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-8 md:p-12 shadow-sm">
                <p class="text-gray-700 mb-6 leading-relaxed">
                    <span class="font-black text-gray-900">COZZY</span> was born from a simple obsession: why should high-end quality be stiff? We believe that style and comfort are not mutually exclusive.
                </p>
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Every piece in our collection is meticulously crafted with high-grade materials, designed for those who value the "Cozzy" lifestyle—effortless, premium, and authentic.
                </p>

                <div class="pt-8 border-t border-gray-100">
                    <h3 class="text-xl font-black text-gray-900 mb-6 uppercase tracking-tight">Our Philosophy</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                                <i class="ph ph-diamond text-indigo-600 text-xl"></i>
                            </div>
                            <h4 class="font-black text-indigo-600 mb-2 uppercase tracking-tight text-sm">Quality First</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">We don't do fast fashion. We do lasting fashion. Our fabrics are chosen to endure the test of time and wash.</p>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                                <i class="ph ph-feather text-indigo-600 text-xl"></i>
                            </div>
                            <h4 class="font-black text-indigo-600 mb-2 uppercase tracking-tight text-sm">Modern Minimalist</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">Clean lines, neutral tones, and versatile fits. Cozzy is designed to blend seamlessly into your curated wardrobe.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-3 bg-gray-900 text-white font-black py-4 px-10 rounded-2xl hover:bg-black transition-all shadow-2xl shadow-gray-200 uppercase text-xs tracking-widest">
                    Back to Catalog <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>