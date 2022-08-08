<div class="w-100 bg-white rounded-2xl flex flex-col md:flex-row justify-around p-6 shadow-md border border-gray-300 mb-6">
    <!-- <img alt="cart" src="img/illustrations/shopping_cart.svg" class="w-60"> -->
    <div class="flex flex-col justify-center items-center w-full">
        <div class="w-full">
            <p class="text-2xl font-semibold mb-2">Stai cercando qualcosa?</p>

        </div>
        
        <form class="w-full mb-3 flex flex-col md:flex-row" action="<?= base_url() ?>/annunci">
            <div class="w-full md:w-1/2 md:pr-4">
                <label class="text-gray-400 text-lg" for="cosa">Cosa?</label>
                <input class="w-full mb-2 bg-gray-50 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md  py-2 px-4 shadow-sm focus:outline-none focus:border-violet-500 focus:ring-violet-500 focus:ring-0 sm:text-lg" placeholder="Qualcosa, un computer, una bici..."type="text" name="cosa"/>
            </div>
            <div class="w-full md:w-1/2">
                <label class="text-gray-400 text-lg" for="dove">Dove?</label>
                <div class="flex">
                    <input class="w-full bg-gray-50 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-l-md  py-2 px-4 shadow-sm focus:outline-none focus:border-violet-500 focus:ring-violet-500 focus:ring-0 sm:text-lg" placeholder="Comune o provincia o regione, fai tu..."  type="text" name="dove"/>
                    <button type="submit" class="bg-violet-500 border-y border-r border-violet-500 rounded-r-md px-6 text-white text-xl font-semibold">Cerca</button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<div class="mb-6">
    <h1 class="text-2xl font-bold mb-4 ">Novità su JustSold</h1>
    
    <div class="grid grid-cols-2 md:grid-cols-4 2xl:grid-cols-5 gap-4">
        <!-- <a href="/" class="">
            <img src="https://img.clasf.it/2020/05/10/Apple-iPhone-11-128-gb-rosso-usato-20200510105059.8139650015.jpg" alt="img" class="w-full h-44 object-cover mb-3 rounded-xl">
            <h1 class="text-xl font-semibold mx-1">Titolo</h1>
            <h2 class="text-md font-semibold mt-0 mx-1 text-gray-400 ">Mira, Venezia, Veneto</h2>
            <h1 class="text-xl font-semibold mt-0 mb-1 mx-1 text-black">50.00 €</h1>
        </a> -->
        <?php
            foreach ($annunci as $key => $annuncio) {
                //var_dump($annuncio);
                echo view('advertisement/card', $annuncio);
            }
        ?>
    </div>
</div>
<h1 class="text-2xl font-bold mb-4">Esplora le categorie</h1>
<div class="grid gap-4 grid-cols-2 lg:grid-cols-4">
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[0]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-red-400 text-red-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[0]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[1]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-blue-400 text-blue-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[1]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[2]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-yellow-400 text-yellow-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[2]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[3]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-orange-400 text-orange-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[3]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[4]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-cyan-400 text-cyan-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[4]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[5]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-pink-400 text-pink-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[5]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[6]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-indigo-400 text-indigo-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[6]['nome'] ?></a>
    <a href="<?= base_url() ?>/annunci?categoria=<?= $categoria[7]['nome'] ?>" class="shadow-md transition-all hover:scale-105 hover:shadow-lg bg-green-400 text-green-900 font-semibold text-lg flex justify-center align-center p-4 rounded-lg"><?= $categoria[7]['nome'] ?></a>
</div>

