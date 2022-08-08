<section class="p-8 mx-auto w-full md:w-5/7 lg:w-2/3 rounded-2xl bg-white shadow-md">
        <div class="flex items-baseline ">
            <a href="<?= base_url() ?>"><h1 class="text-4xl font-bold mr-auto"><span class="text-violet-500">Just</span>Sold</h1></a>
            <h1 class="text-3xl font-light ml-2">Nuovo annuncio</h1>
        </div>
        
        <div class="h-1 rounded-xl bg-gray-100 w-20 mt-2"></div>

        <form action="<?= base_url() ?>/annunci/carica" method="POST" enctype="multipart/form-data" class="mt-6">

            
            <label class="text-gray-900" for="titolo">Inserisci le informazioni.</label>
            <input id="titolo" class="w-full  bg-violet-50/50 rounded-r-lg mt-2 text-gray-900 placeholder:text-gray-400 block border-l-2 border-violet-100 py-2 px-4 focus:outline-none focus:border-green-400 focus:ring-0 text-lg sm:text-xl" type="text" name="titolo" placeholder="Titolo annuncio" required/>
            <textarea id="descrizione" name="descrizione" class="w-full bg-violet-50/50 rounded-r-lg mt-2 text-gray-900 placeholder:text-gray-400 block border-l-2 border-violet-100 py-2 px-4 focus:outline-none focus:border-green-400 focus:ring-0 text-sm sm:text-md" rows="5" placeholder="Inserisci una descrizione dell'articolo che vendi..."></textarea>

            <div class="flex w-100 my-3">
                <div class="px-3 py-2 border-l-2 border-violet-100 bg-violet-50/50 rounded-r-lg mr-2 w-1/2">
                <label class="text-gray-900" for="condizioni">Condizioni</label>
                    <select id="condizioni" required name="condizioni" class="block w-full mt-2 rounded-md p-1 text-sm sm:text-md focus:outline-none focus:ring-0 hover:cursor-pointer required:invalid:text-gray-400">
                        <option value="" disabled selected hidden class="">Scegli...</option>
                        <?php
                            foreach ($condizioni as $c) {
                                echo "<option class='text-black'>" . $c['condizioni'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="px-3 py-2 border-l-2 border-violet-100 bg-violet-50/50 rounded-r-lg ml-2 w-1/2">
                    <label class="text-gray-900" for="categoria">Categoria</label>
                    <select id="categoria" required name="categoria" class="block w-full mt-2 rounded-md p-1 text-sm sm:text-md focus:outline-none focus:ring-0 hover:cursor-pointer required:invalid:text-gray-400">
                        <option value="" disabled selected hidden class="">Scegli...</option>
                        <?php
                            foreach ($categoria as $c) {
                                echo "<option class='text-black'>" . $c['nome'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <!-- <label class="text-gray-400" for="images">Immagini</label> -->
            <!-- <input class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-400 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" type="file" name="immagine"/> -->
            
           <div class="my-3 border-l-2 border-violet-100 w-100 bg-violet-50/50 pr-2 rounded-r-lg">
                <label class="text-gray-900 ml-3" for="comune">Dove ti trovi?</label>
                <div class="flex w-100 pl-3">
                    <div class="pr-1 py-2 w-1/3">
                        <input id="comune" class="w-full rounded-md my-2 text-gray-900 placeholder:text-gray-400 block py-2 px-4 focus:outline-none focus:border-violet-700 focus:ring-0 text-sm sm:text-md" type="text" name="comune" placeholder="Comune" required/>
                    </div>
                    <div class="px-1 py-2 w-1/3">
                        <input id="provincia" class="w-full rounded-md my-2 text-gray-900 placeholder:text-gray-400 block py-2 px-4 focus:outline-none focus:border-violet-700 focus:ring-0 text-sm sm:text-md" type="text" name="provincia" placeholder="Provincia" required/>
                    </div>
                    <div class="pl-1 py-2 w-1/3">
                        <input id="regione" class="w-full rounded-md my-2 text-gray-900 placeholder:text-gray-400 block py-2 px-4  focus:outline-none focus:border-violet-700 focus:ring-0 text-sm sm:text-md" type="text" name="regione" placeholder="Regione"  required/>
                    </div>
                </div>
            </div>                
            
            <div class="flex w-100 mb-3">
                <div class="px-3 py-2 border-l-2 border-violet-100 bg-violet-50/50 rounded-r-lg  mr-2 w-1/2">
                    <label class="text-gray-900" for="prezzo">Prezzo (€)</label>
                    <input id="prezzo" class="w-full bg-white mt-2 text-gray-900 placeholder:text-gray-400 block  py-2 px-4 focus:outline-none focus:border-red-400 focus:ring-0 text-sm sm:text-md" type="number" name="prezzo" value="0.00" min="0.10" max="10000.00" step="0.01" required/>
                </div>
                <div class="px-3 py-2 border-l-2 border-violet-100 bg-violet-50/50 rounded-r-lg ml-2 w-1/2">
                    <label class="text-gray-900 block" for="consegna">Modalità di consegna</label>
                    <label class="inline-flex items-center mt-4 ">
                        <input id="spedizione" type="checkbox" name="spedizione" class="form-checkbox accent-violet-700 scale-125" checked>
                        <span class="ml-2">Spedizione disponibile</span>
                    </label>
                </div>
            </div>

            <div class="">
                <label class="text-gray-900 text-lg block mb-2 mt-1" >Immagini</label>
                <div class="flex flex-wrap gap-2" id="img_container">
                    <div>
                        <label for="img_inp1" class="block rounded-lg border w-28 h-28 hover:cursor-pointer">
                            <input accept="image/*" type='file' id="img_inp1" name="img_inp1" style="visibility: hidden; position: absolute;"/>
                            <img id="preview1" src="/img/adv_images/addimage.png" alt="your image" class="w-full h-full object-cover rounded-lg"/>
                        </label>
                    </div>
                </div>
                <label class="text-gray-400 text-md underline block mb-2 mt-1 hidden hover:cursor-pointer" id="img_del">Elimina immagini</label>
            </div>

            <div class="flex items-baseline mt-6">
                <input type="submit" value="Pubblica" class="block ml-auto text-lg py-2 px-6 rounded-lg border-2 border-violet-400 font-medium bg-violet-700 text-white hover:bg-violet-700/80"/>
            </div>
        </form>
    </section>