<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li><Link href="/login">Login</Link></li>
                    <li><Link href="/registro">Registro</Link></li>
                </ul>
            </nav>
        </header>
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
export default {
    name: "Layout"
};
</script>