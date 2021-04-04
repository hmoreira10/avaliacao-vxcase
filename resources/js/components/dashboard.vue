<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        SaleSystem
                    </h1>
                    <h2 class="subtitle">
                        System to manage your sales.
                    </h2>
                </div>
            </div>
        </section>
        <section>
            <list-sales />
        </section>
    </div>
</template>
<script>
import listSales from './partials/listSales'
export default {
    components: {
        listSales,
    }
}
</script>
