<template>
    <div>
        <div class="loading">
            <div class="lds-dual-ring">
            </div>
            <div class="text-amber-500">{{ text }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'spinner',
    props: {
        text : {
            required : false, 
            type : String,
            default : 'Sedang Memuat...'
        }
    }
};
</script>


<style scoped>
.loading {
    text-align: center;
    position: fixed;
    top: 30%;
    width: 25%;
    padding: 10px;
    margin: auto;
    z-index: 999;
    background-color: rgb(255, 255, 255);
    box-shadow: 0px 0px 9px -2px #000;
    border-radius: 10px;
    left: 0;
    right: 0;
}

.lds-dual-ring {
    color: #ffc107;
}

.lds-dual-ring,
.lds-dual-ring:after {
    box-sizing: border-box;
}

.lds-dual-ring {
    display: inline-block;
    width: 80px;
    height: 80px;
}

.lds-dual-ring:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 8px;
    border-radius: 50%;
    border: 6.4px solid currentColor;
    border-color: currentColor transparent currentColor transparent;
    animation: lds-dual-ring 1.2s linear infinite;
}

@keyframes lds-dual-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>