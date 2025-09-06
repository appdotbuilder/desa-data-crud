import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Sistem Pendataan Potensi Desa">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col bg-gradient-to-br from-green-50 to-blue-50 text-gray-800 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
                {/* Header */}
                <header className="w-full px-6 py-4 lg:px-8">
                    <nav className="flex items-center justify-between">
                        <div className="flex items-center space-x-2">
                            <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-r from-green-500 to-blue-500 text-white font-bold text-lg">
                                🏘️
                            </div>
                            <span className="text-xl font-bold">SiPoDes</span>
                        </div>
                        <div className="flex items-center space-x-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="rounded-lg bg-gradient-to-r from-green-500 to-blue-500 px-6 py-2 text-white font-medium hover:from-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors dark:text-gray-300 dark:hover:text-gray-100"
                                    >
                                        Masuk
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="rounded-lg bg-gradient-to-r from-green-500 to-blue-500 px-6 py-2 text-white font-medium hover:from-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl"
                                    >
                                        Daftar
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <div className="flex-1 flex items-center justify-center px-6 lg:px-8">
                    <div className="max-w-6xl w-full">
                        <div className="text-center mb-12">
                            <h1 className="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                                📊 Sistem Informasi Potensi Desa
                            </h1>
                            <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                                Platform komprehensif untuk mengelola dan memantau data potensi desa dengan sistem multi-level yang aman dan efisien
                            </p>
                            
                            {!auth.user && (
                                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                    <Link
                                        href={route('login')}
                                        className="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-green-500 to-green-600 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                                    >
                                        🔑 Masuk Sekarang
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-gray-700 bg-white rounded-lg border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:border-gray-500"
                                    >
                                        📝 Daftar Gratis
                                    </Link>
                                </div>
                            )}
                        </div>

                        {/* Features Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                <div className="text-4xl mb-4">👥</div>
                                <h3 className="text-lg font-semibold mb-2">Data Demografi</h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">Kelola data penduduk lengkap dengan KK, NIK, dan profil demografis</p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                <div className="text-4xl mb-4">🏪</div>
                                <h3 className="text-lg font-semibold mb-2">UMKM & Ekonomi</h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">Monitor potensi ekonomi dan UMKM dengan mapping lokasi</p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                <div className="text-4xl mb-4">🌾</div>
                                <h3 className="text-lg font-semibold mb-2">Sumber Daya Alam</h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">Data pertanian, perkebunan, kehutanan, dan peternakan</p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                <div className="text-4xl mb-4">🏗️</div>
                                <h3 className="text-lg font-semibold mb-2">Infrastruktur</h3>
                                <p className="text-gray-600 dark:text-gray-300 text-sm">Fasilitas umum, pendidikan, kesehatan dengan koordinat GPS</p>
                            </div>
                        </div>

                        {/* Role-based Access */}
                        <div className="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl mb-12">
                            <h2 className="text-3xl font-bold text-center mb-8">🔐 Sistem Multi-Level Akses</h2>
                            <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div className="text-center p-4 rounded-lg bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20">
                                    <div className="text-3xl mb-3">👑</div>
                                    <h4 className="font-semibold text-red-700 dark:text-red-300">Super Admin</h4>
                                    <p className="text-sm text-red-600 dark:text-red-400 mt-2">Akses penuh ke semua fitur dan data</p>
                                </div>
                                
                                <div className="text-center p-4 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20">
                                    <div className="text-3xl mb-3">🏛️</div>
                                    <h4 className="font-semibold text-blue-700 dark:text-blue-300">Admin Kabupaten</h4>
                                    <p className="text-sm text-blue-600 dark:text-blue-400 mt-2">Rekap semua kecamatan dan desa</p>
                                </div>
                                
                                <div className="text-center p-4 rounded-lg bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20">
                                    <div className="text-3xl mb-3">🏢</div>
                                    <h4 className="font-semibold text-green-700 dark:text-green-300">Admin Kecamatan</h4>
                                    <p className="text-sm text-green-600 dark:text-green-400 mt-2">Data desa di wilayahnya</p>
                                </div>
                                
                                <div className="text-center p-4 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20">
                                    <div className="text-3xl mb-3">🏘️</div>
                                    <h4 className="font-semibold text-purple-700 dark:text-purple-300">Admin Desa</h4>
                                    <p className="text-sm text-purple-600 dark:text-purple-400 mt-2">Kelola data desa sendiri</p>
                                </div>
                            </div>
                        </div>

                        {/* Key Features */}
                        <div className="grid md:grid-cols-3 gap-8 mb-12">
                            <div className="text-center">
                                <div className="bg-gradient-to-r from-green-500 to-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                                    📈
                                </div>
                                <h3 className="text-xl font-semibold mb-2">Dashboard Analitik</h3>
                                <p className="text-gray-600 dark:text-gray-300">Visualisasi data dengan Chart.js, statistik real-time, dan laporan interaktif</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="bg-gradient-to-r from-green-500 to-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                                    📤
                                </div>
                                <h3 className="text-xl font-semibold mb-2">Export & Import</h3>
                                <p className="text-gray-600 dark:text-gray-300">Import dari Excel, export ke PDF/Excel, dan sinkronisasi data otomatis</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="bg-gradient-to-r from-green-500 to-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                                    🔒
                                </div>
                                <h3 className="text-xl font-semibold mb-2">Keamanan Tinggi</h3>
                                <p className="text-gray-600 dark:text-gray-300">CSRF protection, audit trail, dan enkripsi data untuk keamanan maksimal</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="px-6 py-8 border-t border-gray-200 dark:border-gray-700">
                    <div className="max-w-6xl mx-auto text-center">
                        <p className="text-gray-600 dark:text-gray-400">
                            © 2024 Sistem Informasi Potensi Desa. Dibangun dengan ❤️ menggunakan Laravel & React.
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}