<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl p-4 w-1/3">
        <form>
            <div>
                <label>Nome</label>
                <input type="text" wire:model="name" class="w-full rounded" required>
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Descrição</label>
                <textarea wire:model="description" class="w-full rounded"></textarea>
            </div>

            <div>
                <label>Preço Venda</label>
                <input type="number" wire:model="price_sell" class="w-full rounded">
                @error('price_sell') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Preço Compra</label>
                <input type="number" wire:model="price_buy" class="w-full rounded">
                @error('price_buy') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Quantidade</label>
                <input type="number" wire:model="quantity" class="w-full rounded">
                @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Category</label>
                <select wire:model="category_id" class="w-full rounded">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>
            </div>

             <label>Image</label>
            <input type="file" wire:model="image" class="w-full rounded">
            <div class="mt-4">
                <button wire:click.prevent="store" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>

