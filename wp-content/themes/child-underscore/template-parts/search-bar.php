<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" style="margin:0; padding:0; border:none;">
    <input
        type="search"
        class="form-control"
        placeholder="Search..."
        value="<?php echo get_search_query(); ?>"
        name="s"
        title="Search for:">
    <button type="submit" style="background: #f75757;" class="btn btn-mian btn-small d-block mt-2 w-100">Search</button>
</form>