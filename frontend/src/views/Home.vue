<template>
    <div class="home">
        <div class="jumbotron">
            <div class="row">
                <div class="hero-overlay"></div>
                <div class="col-7 p-4">
                    <h1 class="mt-4">Video Title Video Title Video Title</h1>
                    <p>2022 | 2H 23m</p>
                    <p>
                        Soda and Gembria are two best friends who have a lot in common.
                        Their friendship begins to fall apart when they meet Jennie,
                        a beautiful woman who is also an environmental activist.
                        They were both interested and tried...
                    </p>
                    <button class="btn btn-md btn-warning">▶ Play</button>
                </div>
                <div class="col-5 hero">
                    <img class="img img-responsive hero-img" src="@/assets/image/hero.png" alt="Baseball Image">
                </div>
            </div>
        </div>
    </div>
    <section class="mt-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HomeWeb'
}
</script>


<style scoped>
.home {
    align-items: center;
    padding: 40px;
    background: linear-gradient(360deg, #01377F 69.71%, rgba(0, 55, 127, 0) 100%);
    color: #ffffff;
}


.hero-img {
    position: absolute;
    top: 0;
    right: 0;
    width: 650px;
    height: 400px;
    object-fit: cover;
}

section {
    overflow: hidden;
    padding-left: 30px;
    padding-bottom: 30px;
}
</style>