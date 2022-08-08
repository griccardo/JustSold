<a href="<?=base_url()?>/annunci/scheda/<?=$annuncio_id?>" class="flex bg-white items-center rounded-lg h-52 hover:cursor-pointer transition-all hover:scale-[1.01] hover:shadow-lg hover:brightness-90">
    <img src="<?= (empty($path)?'img/adv_images/no-image.jpg':$path) ?>" alt="<?=$titolo?>" class="w-60 h-52 object-cover rounded-l-xl border ">
    <div class="pl-4 h-fit">
        <h2 class="text-sm mb-3 mx-1 text-gray-400 capitalize"> <?=$data_pubblicazione?></h2>
        <h1 class="text-xl font-semibold mx-1"><?=$titolo?></h1>
        <h2 class="text-md  mt-0 mx-1 text-gray-400 capitalize"><?=$comune?>, <?=$provincia?>, <?=$regione?></h2>
        <h1 class="text-xl font-bold mt-0 mb-1 mx-1 text-black"><?=$prezzo?> €</h1>
    </div>
    <div class="block h-full ml-auto pr-6 py-6 flex flex-col">
        <?=
            ($prefe?'<i class="fa-solid fa-heart text-red-500 text-2xl" title="articolo tra i tuoi preferiti"></i>':'')
        ?>
        
        <?= ($is_spedibile == "SPEDIBILE" ?
        '<i class="fa-solid fa-truck text-gray-200 text-2xl mt-auto" title="disponibile ritiro a mano e spedizione"></i>':
        '<i class="fa-solid fa-people-arrows-left-right text-gray-200 text-2xl mt-auto" title="disponibile solo ritiro a mano"></i>'
        ) ?>
    </div>
    
</a>