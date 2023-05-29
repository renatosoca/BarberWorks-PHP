<div class="w-full flex items-center pb-8" >
    <label for="title" class="pr-2 text-xl min-w-[7rem]" >Titulo</label>
    <input 
        class="text-black flex-1 px-4 py-2 rounded outline-none" 
        type="text" 
        name="title" 
        id="title" 
        placeholder="Tu titulo" 
        value="<?php echo $service->title; ?>"
    >
</div>

<div class="w-full flex items-center pb-8">
    <label for="price"class="pr-2 text-xl min-w-[7rem]" >Precio</label>
    <input 
        class="text-black flex-1 px-4 py-2 rounded outline-none" 
        type="number" 
        name="price" 
        id="price" 
        placeholder="El precio" 
        value="<?php echo $service->price; ?>"
    >
</div>