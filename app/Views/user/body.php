<h1 class="text-2xl font-bold mb-4 ">Modifica il tuo profilo</h1>
<div class="flex items-center">
    <div class="w-full md:w-4/5 lg:w-2/3 xl:w-1/2">
        <form action="<?= base_url() ?>/utente/modifica" method="POST" class="mt-6">
            <label class="text-gray-400" for="nome">Nome</label>
            <input value="<?= $_SESSION['dati_utente']['nome'] ?>" class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="Will" type="text" name="nome" required/>
            <label class="text-gray-400" for="Cognome">Cognome</label>
            <input value="<?= $_SESSION['dati_utente']['cognome'] ?>" class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="Smith" type="text" name="cognome" required/>
            <label class="text-gray-400" for="nascita">Data di nascita</label>
            <input value="<?= $_SESSION['dati_utente']['data_nascita'] ?>" class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm"  type="date" name="nascita" required/>
            <label class="text-gray-400" for="telefono">Telefono</label>
            <input value="<?= $_SESSION['dati_utente']['telefono'] ?>" class="w-full bg-gray-50 mb-3 text-gray-900 placeholder:italic placeholder:text-gray-300 block border border-gray-300 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="+12 3456789" type="text" name="telefono" required/>
            <label class="text-gray-400" for="email">Email</label>
            <input value="<?= $_SESSION['dati_utente']['email'] ?>" class="w-full bg-gray-50/50 mb-3 text-gray-600 placeholder:italic placeholder:text-gray-300 block border border-gray-200 rounded-md py-2 px-4 shadow-sm focus:outline-none focus:border-violet-700 focus:ring-0 sm:text-sm" placeholder="example@example.com" type="email" name="email" disabled title="non puoi modificare l'indirizzo email"/>
            <div class="flex items-baseline mt-6">
                <input type="submit" value="Modifica" class="block ml-auto text-lg py-2 px-6 rounded-lg border-2 border-violet-400 font-medium bg-violet-700 text-white hover:bg-violet-700/80"/>
            </div>
        </form>
    </div>
    <div class="hidden lg:block lg:w-1/3 xl:w-1/2 lg:px-16 xl:px-24 2xl:px-40">
        <img src="/img/illustrations/profile.svg" alt="profile" class="w-full" style="max-width: 600px;">
    </div>
</div>