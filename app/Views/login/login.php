<div  style="min-height: calc(100vh - 2.5rem) !important;" class="flex items-center pb-4">
    <section id="login_modal" class="p-8 mx-auto w-full md:w-2/3 lg:w-1/2 rounded-2xl bg-white shadow-md ">
        <div class="flex items-center ">
            <a href="<?= base_url() ?>"><img src="/img/justsold.svg" alt="logo" class="w-44"></a>
            <h1 class="text-3xl font-light ml-2 pt-4 ">Accesso</h1>
        </div>
        
        <div class="h-1 rounded-xl bg-gray-100 w-20 mt-2"></div>
        <?php 
            // mostro gli errori se presenti
            if(isset($_GET['error'])){
                if($_GET['error'] == 1){
                    echo view('login/error_banner', ['error_text' => 'email e/o password vuota']);
                } elseif ($_GET['error'] == 2){
                    echo view('login/error_banner', ['error_text' => 'email non trovata']);
                } elseif ($_GET['error'] == 3){
                    echo view('login/error_banner', ['error_text' => 'password errata']);
                }
            }else{
                echo '
                <div class="bg-gray-100 p-3 mt-3 text-lg font-semibold text-gray-700 rounded-xl w-100">
                    <h2>Inserisci qui sotto le tue credenziali.</h2>
                </div>';
            }
        ?>


        <form action="<?= base_url() ?>/accesso/verifica<?=(isset($_GET['source'])?"?source=".$_GET['source']:"") ?>" method="POST" class="mt-6">
            <label class="text-gray-400" for="email">Email</label>
            <input class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="example@example.com" type="email" name="email" required/>
            <label class="text-gray-400 mt-3" for="password">Password</label>
            <div class="w-full mb-3 flex">
                <input id="pw" class="w-full bg-gray-50 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-l-md focus:rounded-r-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="Super secure password" type="password" name="password" required/>
                <button type="button" id="pw_button" class="bg-gray-50 border-y border-r border-gray-300 rounded-r-md px-2 text-gray-400">mostra</button>
            </div>
            <div class="flex items-baseline mt-6">
                <p class="text-lg text-gray-400">
                    Non hai un account?<a href="<?= base_url() ?>/accesso/nuovo" class="underline decoration-violet-700 hover:text-violet-700 hover:cursor-pointer">Registrati ora</a>!
                </p>
                <input type="submit" value="Accedi" class="block ml-auto text-lg py-2 px-6 rounded-lg border-2 border-violet-400 font-medium bg-violet-700 text-white hover:bg-violet-700/80"/>
            </div>
        </form>
    </section>
</div>