<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Saran Digital - Universitas Gunung Kidul</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ugk: {
                            blue: '#004a99',
                            dark: '#003366',
                            light: '#f0f7ff',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2f7 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        /* Animasi Loading */
        .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }
        @-webkit-keyframes spinner { 0% { -webkit-transform: rotate(0deg); } 100% { -webkit-transform: rotate(360deg); } }
        @keyframes spinner { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="antialiased text-gray-800">

    <div class="container mx-auto px-4 py-10">
        
        <div class="flex justify-center mb-8">
            @php $logo = optional($footerSettings->get('logo_utama'))->getUrl(); @endphp
            @if($logo)
                <img src="{{ $logo }}" alt="Logo UGK" class="h-20 w-auto">
            @else
                <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold">Logo Belum Diupload</span>
            @endif
        </div>

        <div class="max-w-xl mx-auto">
            <div class="glass-card rounded-[2rem] shadow-2xl overflow-hidden border border-white">
                
                <div class="bg-ugk-blue p-8 text-center text-white">
                    <h1 class="text-2xl font-bold tracking-tight">KOTAK SARAN UGK</h1>
                    <p class="text-blue-100 text-sm mt-2 opacity-90">Saranmu Membangun UGK Menjadi Lebih Unggul</p>
                </div>

                <div class="p-8 md:p-10">
                    
                    <script type="text/javascript">var submitted=false;</script>
                    <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;" onload="if(submitted) { handleSuccess(); }"></iframe>

                    <form action="https://docs.google.com/forms/d/e/1FAIpQLSeqLspti_7cY9PINMxzjmcwZmXVBqLFELCSMsYB39Yj1uKLgg/formResponse" 
                          method="POST" 
                          target="hidden_iframe" 
                          onsubmit="return handleSubmit();"
                          id="gform">
                        
                        {{-- @csrf dihapus: form ini dikirim ke Google Forms (external domain),
                             bukan ke server Laravel. Token CSRF tidak relevan di sini. --}}

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Masukan Nama Anda *</label>
                                <input type="text" name="entry.2005620554" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-ugk-blue focus:border-transparent outline-none transition-all placeholder-gray-400 bg-gray-50" placeholder="Nama Lengkap" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Masukan NIM Anda *</label>
                                <input type="text" name="entry.801116347" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-ugk-blue focus:border-transparent outline-none transition-all placeholder-gray-400 bg-gray-50" placeholder="Nomor Induk Mahasiswa" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Masukan Jurusan Anda *</label>
                                <input type="text" name="entry.1045781291" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-ugk-blue focus:border-transparent outline-none transition-all placeholder-gray-400 bg-gray-50" placeholder="Contoh: Administrasi Publik" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Masukan Saran Anda Untuk UGK *</label>
                                <textarea name="entry.1065046570" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-ugk-blue focus:border-transparent outline-none transition-all placeholder-gray-400 bg-gray-50 resize-none" placeholder="Tuliskan aspirasi Anda..." required></textarea>
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="submit" id="btn-submit" class="w-full bg-ugk-blue hover:bg-ugk-dark text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-95 flex justify-center items-center gap-2">
                                    <span>Kirim Aspirasi Sekarang</span>
                                </button>
                                
                                <a href="{{ route('home') }}" class="w-full bg-white border-2 border-gray-200 hover:border-gray-300 text-gray-600 font-bold py-3 rounded-xl transition-all flex justify-center items-center gap-2 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Batal & Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </form>

                    <div id="success-message" class="hidden text-center py-10">
                        <div class="bg-green-100 text-green-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Berhasil Dikirim!</h2>
                        <p class="text-gray-500 mt-2">Terima kasih atas saran Anda untuk UGK.</p>
                        
                        <div class="mt-8 flex flex-col gap-3">
                            <button onclick="window.location.reload();" class="text-ugk-blue font-semibold hover:underline">Kirim saran lain</button>
                            <a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-gray-600">Selesai & Keluar</a>
                        </div>
                    </div>

                </div>
            </div>
            
            <p class="text-center text-gray-400 text-xs mt-8">
                &copy; 2026 Universitas Gunung Kidul &bull; Internship Kemenaker Project
            </p>
        </div>
    </div>

    <script>
        function handleSubmit() {
            submitted = true;
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = '<div class="loader ease-linear rounded-full border-2 border-t-2 border-gray-200 h-5 w-5"></div> Mengirim...';
            return true;
        }

        function handleSuccess() {
            document.getElementById('gform').classList.add('hidden');
            document.getElementById('success-message').classList.remove('hidden');
        }
    </script>

    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>