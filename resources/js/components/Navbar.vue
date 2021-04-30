<template>
    <div class="navbar-wrapper">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-10">
                    <div class="logo paddings">
                        Cool Project Name - {{currentDate}}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="profile ">
                        <i class="fas fa-user-circle profile-logo align-middle" ></i> Your Name

                        <i class="fas fa-sort-down float-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Navbar",
    computed: {
        currentDate() {
            return new Date().toJSON().slice(0,10).replace(/-/g,'/');
        }
    }
}
</script>

<style scoped>
.container-xl {
    max-width: 1340px;
}
.navbar-wrapper {
    background-color: #f9992d;
    color: #fffefd;
}
.profile {
    background-color: #7f4c12;
    padding-top: 15px;
    margin-top: 5px;
    padding-bottom: 15px;
    margin-bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
}
.profile-logo {
    font-size: 30px;
}
.logo {
    padding-top: 20px;
    padding-bottom: 20px;
}

</style>
