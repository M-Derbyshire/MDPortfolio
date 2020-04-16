@include('admin.partials.inputContainer', [
    'inputName' => 'order',
    'inputLabel' => 'Order Position (Lower numbers will show first.):',
    'inputField' => '<input 
        type="number" 
        class="form-control" 
        name="order" 
        min="0" 
        max="999"
        step="0.01"
        id="orderInput" 
        value="'.($order ?? (old('order')) ?? 0).'" 
    />'
])