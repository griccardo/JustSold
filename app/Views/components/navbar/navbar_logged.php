<nav class="w-100 p-2 flex items-center mb-4">
   
    <a href="<?= base_url() ?>"><img src="/img/justsold.svg" alt="logo" class="w-44"></a>
    
    <div class="ml-auto flex ">
        <!-- <a href="<?= base_url() ?>/annunci/nuovo"><h2 class="transition-all text-xl font-semibold mr-6 hover:animate-pulse hover-underline-animation">Nuovo annuncio</h2></a>
        <a href="<?= base_url() ?>/utente"><h2 class="transition-all text-xl font-semibold mr-6 hover:animate-pulse hover-underline-animation capitalize"><?= $_SESSION['dati_utente']['nome'] . " " . $_SESSION['dati_utente']['cognome'] ?></h2></a>
        <a href="<?= base_url() ?>/accesso/esci"><h2 class="transition-all text-xl font-semibold mr-6 hover:animate-pulse hover-underline-animation">Esci</h2></a> -->
        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" data-dropdown-placement="bottom-end" class="text-white bg-violet-500 hover:bg-violet-600 focus:outline-none font-medium rounded-lg text-xl px-4 py-2.5 text-center inline-flex items-center ring-0 capitalize w-18" type="button"><i class="fa-solid fa-bars"></i></button>

        <!-- Dropdown menu -->
        <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl">
            <div class="px-4 py-3 text-sm text-gray-900">
                <div class="capitalize"><?= $_SESSION['dati_utente']['nome'] . " " . $_SESSION['dati_utente']['cognome'] ?></div>
                <div class="font-medium truncate"><?= $_SESSION['dati_utente']['email'] ?></div>
            </div>
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownInformationButton">
            <li>
                <a href="<?= base_url() ?>/annunci/nuovo" class="block px-4 py-2 hover:bg-gray-100 ">Nuovo annuncio</a>
            </li>
            <li>
                <a href="<?= base_url() ?>/utente" class="block px-4 py-2 hover:bg-gray-100 ">Profilo</a>
            </li>
            <li>
                <a href="<?= base_url() ?>/annunci/preferiti" class="block px-4 py-2 hover:bg-gray-100 ">Preferiti</a>
            </li>
            <li>
                <a href="<?= base_url() ?>/annunci/pubblicati" class="block px-4 py-2 hover:bg-gray-100 ">Annunci pubblicati</a>
            </li>
            </ul>
            <div class="py-1">
            <a href="<?= base_url() ?>/accesso/esci" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Esci</a>
            </div>
        </div>
    </div>

</nav>