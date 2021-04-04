<template>
   <nav class="navbar" role="navigation" aria-label="main navigation">
       <div class="container">
           <div class="navbar-brand">
    <router-link to="/" class="navbar-item" href="#">
     <h1 class="has-text-weight-bold">SaleSystem</h1>
    </router-link>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="PrimaryNavbar">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="PrimaryNavbar" class="navbar-menu">
    <div class="navbar-start">

    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <router-link class="button is-primary" to="/create"><strong>Nova Venda</strong></router-link>
        </div>
      </div>
    </div>
  </div>
       </div>
</nav>
</template>



<script>
    export default {
        name: "NavbarComponent",
         created(){
             document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
                });
            }

            });
         }
    }
</script>
