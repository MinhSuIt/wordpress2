<?php
?>


<a href="#search-lightbox" class="is-small custom-search-icon" aria-label="Search" data-open="#search-lightbox" data-focus="input.search-field" role="button" aria-expanded="false" aria-haspopup="dialog" aria-controls="search-lightbox">
    <i class="icon-search" style="font-size:16px;"></i>
</a>



<div id="search-lightbox" class="dark text-center !fixed z-[9999] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-5">
    <div class="searchform-wrapper ux-search-box relative is-large">
        <form method="get" class=" rounded-4xl flex overflow-hidden w-full" role="search">
            <input
                type="search"
                name="s"
                placeholder="Nhập từ khóa..."
                autocomplete="off"
                class="flex-grow !pl-3 !pr-6 text-sm !text-gray-800 placeholder-gray-400
           focus:outline-none border-0" />

            <button
                type="submit"
                aria-label="Search"
                class="px-4 flex items-center justify-center text-white hover:brightness-110 transition absolute ml-1 right-2">
                <i class="fas fa-search !text-gray-800"></i>
            </button>
        </form>
    </div>
</div>