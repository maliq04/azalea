<!-- Navbar -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     style="background-color: #f7e4ee;">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo (left side) -->
            <div class="flex items-center gap-10">
                <a href="/" class="text-xl font-bold text-gray-800 tracking-tight">
                    Azalea
                </a>

                <!-- Nav Links (right of logo, not too far from edge) -->
                <div class="hidden md:flex items-center gap-7">
                    <a href="/" class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        Home
                    </a>
                    <a href="/templates" class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        Template
                    </a>
                    <a href="/blog" class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        Blog
                    </a>
                </div>
            </div>

            <!-- Auth Links (right side) -->
            <div class="hidden md:flex items-center gap-3">
                <a href="/login"
                   class="text-sm font-medium text-gray-700 hover:text-gray-900 px-4 py-2 rounded-full transition-colors duration-200">
                    Login
                </a>
                <a href="/register"
                   class="text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 px-5 py-2 rounded-full transition-colors duration-200">
                    Register
                </a>
            </div>

            <!-- Mobile menu button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-md text-gray-700 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden pb-4">
            <div class="flex flex-col gap-2 pt-2 border-t border-pink-200">
                <a href="/" class="text-sm font-medium text-gray-700 hover:text-gray-900 py-2 px-1 transition-colors">Home</a>
                <a href="/templates" class="text-sm font-medium text-gray-700 hover:text-gray-900 py-2 px-1 transition-colors">Template</a>
                <a href="/blog" class="text-sm font-medium text-gray-700 hover:text-gray-900 py-2 px-1 transition-colors">Blog</a>
                <div class="flex gap-3 pt-2">
                    <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-900 px-4 py-2 border border-gray-300 rounded-full transition-colors">Login</a>
                    <a href="/register" class="text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 px-4 py-2 rounded-full transition-colors">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Scroll: change navbar bg to white
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            navbar.style.backgroundColor = '#ffffff';
            navbar.style.boxShadow = '0 1px 12px rgba(0,0,0,0.08)';
        } else {
            navbar.style.backgroundColor = '#f7e4ee';
            navbar.style.boxShadow = 'none';
        }
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
