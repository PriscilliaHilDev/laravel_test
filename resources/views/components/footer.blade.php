<footer class="bg-gray-100 dark:bg-[#0a0a0a] text-gray-600 dark:text-gray-400 py-6 mt-12 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        
        <!-- Logo / Nom de l'agence -->
        <div class="flex items-center gap-2">
            <x-application-mark class="h-8 w-auto" />
            <span class="font-semibold text-gray-800 dark:text-gray-200">
                Azuréa IMMO
            </span>
        </div>

        <!-- Navigation rapide -->
        <nav class="flex gap-6 text-sm">
          
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Contact</a>
        </nav>

        <!-- Mentions -->
        <p class="text-xs text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} Blue Orlando. Tous droits réservés.
        </p>
    </div>
</footer>
