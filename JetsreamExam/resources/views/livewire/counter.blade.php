<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    {{-- <h1>Hello, World!</h1> --}}
    <div style="text-align:center" >
        <button wire:click="product">*</button>
        <button wire:click="increment">+</button>
        <h1>{{ $count }}</h1>
        <button wire:click="decrement">-</button>
        <button wire:click="devide">/</button>
    </div>
    <div>
        <input wire:model.lazy="message" type="text" >
        {{-- wire:model.debounce.%%ms %%ms마다 통신 wire:model.lazy 다른곳에 포커싱하거나 엔터 칠 때 까지 통신 안함 --}}
        <h1>{{ $message }}</h1>
    </div>
</div>
