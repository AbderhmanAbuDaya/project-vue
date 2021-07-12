<template>
    <div class="container">
        <not-found v-if="!this.$gate.isAdmin()" ></not-found>

        <div class="row justify-content-center" v-if="this.$gate.isAdmin()">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
