<div class="flex flex-col md:flex-row gap-8">
    <div class="md:sticky md:top-2 w-full md:w-1/3 lg:w-1/4 xl:w-3/8 h-full">
        <?php echo view('advertisement/components/filters'); ?>
    </div>
    <div class="w-full md:w-2/3 lg:w-3/4 xl:w-5/8">
        <?php  echo view('advertisement/components/searchbody', ['annunci' => $annunci, 'preferiti' => $preferiti]); ?> 
    </div>
</div>