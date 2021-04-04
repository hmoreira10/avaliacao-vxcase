<template>
    <div>
        <navbar-component></navbar-component>
        <router-view></router-view>
        <footer class="footer">
        <div class="content has-text-centered">
            <p>
                Sale System
            </p>
        </div>
        </footer>
    </div>
</template>

<script>
    import NavbarComponent from './navbar'
    export default {
        components:{
            NavbarComponent
        },
        data(){
            return {
            }
        }
    }
</script>
