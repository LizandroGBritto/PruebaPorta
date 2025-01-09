<template>
    <div>
        <header>
            <nav>
                <h1 class="flex justify-center font-medium">Prueba Tecnica - Porta</h1>
            </nav>
        </header>
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
export default {
    name: "Layout",
};
</script>
