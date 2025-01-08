<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li><Link href="/">Inicio</Link></li>
                    <li><Link href="/registro">Registro</Link></li>
                </ul>
            </nav>
        </header>
        <main>
            <slot></slot>
        </main>
        <footer>
            <p>© 2025 - Todos los derechos reservados</p>
        </footer>
    </div>
</template>

<script>
export default {
    name: "Layout"
};
</script>