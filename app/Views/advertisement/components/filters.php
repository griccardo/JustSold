<div class="w-full p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-2">Filtra</h2>
    <form class="" action="<?= base_url() ?>/annunci">
           
        <label class="text-gray-400 text-md block" for="cosa">Cosa?</label>
        <input class="w-full mb-2 bg-gray-50 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md  py-2 px-4 shadow-sm focus:outline-none focus:border-violet-500 focus:ring-violet-500 focus:ring-0 sm:text-lg" value="<?= (isset($_GET['cosa']) && $_GET['cosa'] != "" ? $_GET['cosa'] : "") ?>" type="text" name="cosa"/>
    
    
        <label class="text-gray-400 text-md block" for="dove">Dove?</label>
        <input class="w-full mb-2 bg-gray-50 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md  py-2 px-4 shadow-sm focus:outline-none focus:border-violet-500 focus:ring-violet-500 focus:ring-0 sm:text-lg" value="<?= (isset($_GET['dove']) && $_GET['dove'] != "" ? $_GET['dove'] : "") ?>" type="text" name="dove"/>
              
        <label class="text-gray-400 text-md block" for="dove">Categoria</label>
        <select id="categoria" required name="categoria" class="block w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-md  py-2 px-4 shadow-sm focus:outline-none focus:border-violet-500 focus:ring-violet-500 focus:ring-0 sm:text-lg">
            
            <?php
                $selected = false;
                foreach ($categorie as $c) {
                    if(isset($_GET['categoria']) && $_GET['categoria'] == $c['nome']){
                        echo "<option class='text-black' selected>" . $c['nome'] . "</option>";
                        $selected = true;
                    }else{
                        echo "<option class='text-black'>" . $c['nome'] . "</option>";
                    }
                }
            ?>
            <option value="" disabled <?= ($selected?' ':' selected ') ?> hidden class=""></option>
        </select>

        <label class="inline-flex items-center mt-4">
            <input id="spedizione" type="checkbox" name="spedizione" class="form-checkbox ml-1 accent-violet-700 scale-150"  <?= (isset($_GET['spedizione']) && $_GET['spedizione'] == true ? " checked" : "") ?>>
            <span class="ml-2">Solo con spedizione disponibile</span>
        </label>

        <button type="submit" class="bg-violet-500 mt-6 mb-4 border border-violet-500 rounded-md px-6 py-1 text-white text-lg font-semibold w-full">Applica</button>
        <?php
            if((isset($_GET['cosa']) && $_GET['cosa'] != "") || (isset($_GET['dove']) && $_GET['dove'] != "") || isset($_GET['spedizione']) || (isset($_GET['categoria']) && $_GET['categoria'] != "")){
                echo '<a href="'.base_url() .'/annunci" class="underline decoration-violet-700 hover:text-violet-700 hover:cursor-pointer"><i class="fa-solid fa-trash mr-2"></i>Rimuovi tutti i filtri</a>';
            }
        ?>
            
            
    </form>
</div>