<x-app-layout page="documents"> 
    <div>
    <form action="/guardar" method="post" enctype="multipart/form-data" >
        <label for="DNI">Selecciona el DNI:</label>
        <input type="file" name="DNI" id="DNI" multiple><br>
        <label for="Tarjeta sanitaria">Selecciona el Tarjeta sanitaria:</label>
        <input type="file" id="Tarjeta sanitaria" multiple><br>
        <label for="Resguard del titol">Selecciona el Resguard del titol:</label>
        <input type="file" id="Resguard del titol" multiple><br>
        <label for="Resguard del pagament">Selecciona el Resguard del pagament:</label>
        <input type="file" id="Resguard del pagament" multiple><br>
        <input class="btn primary-btn"type="submit" value="Pujar arxius">
    </form>
    </div>
</x-app-layout>

