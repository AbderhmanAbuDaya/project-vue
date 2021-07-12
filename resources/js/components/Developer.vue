<template>
    <div class="container">
        <div class="row justify-content-center">
            <not-found v-if="!this.$gate.isAdmin()" ></not-found>

            <div class="col-md-8" v-if="this.$gate.isAdmin()">
                <div class="card">
                    <div class="card-header">Developer Component</div>

                    <div class="card-body">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>
