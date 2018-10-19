<template>

<div class="row">

    <div class="col-sm-12">

        <ul>
            <li v-for="file in files">
                {{file.error}}


                <b-alert :show="showSucess" variant="success">Imagem alterada com sucesso</b-alert>
                <b-alert :show="showError" variant="danger">Error ao  alterada imagem</b-alert>
                <br/>
                <b-img v-if="file.blob" :src="file.blob" width="600" fluid alt="Responsive image" />

                <br/>
                <br/>
                <br/>

                <div class="progress" v-if="file.active || file.progress !== '0.00'">
                    <div :class="{'progress-bar': true, 'progress-bar-striped': true, 'bg-danger': file.error, 'progress-bar-animated': file.active}" role="progressbar" :style="{width: file.progress + '%'}">{{file.progress}}%</div>
                </div>

            </li>
        </ul>
        <file-upload
                class="btn btn-primary"
                ref="upload"
                v-model="files"
                :post-action="urlUpdate"

                @input-file="inputFile"
                @input-filter="inputFilter"
                :extensions="extensions"
                :size="size || 0"
                :accept="accept"

        >
            <i class="fa fa-plus"></i>
            Selecione um imagem
        </file-upload>
        <button class="btn btn-success" v-show="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true" type="button"><i aria-hidden="true" class="fa fa-arrow-up"></i> Iniciar upload</button>
        <button class="btn btn-danger" v-show="$refs.upload && $refs.upload.active" @click.prevent="$refs.upload.active = false" type="button">Stop upload</button>
        <button class="btn btn-danger"  @click.prevent="remover()">Remove</button>
    </div>
</div>
</template>

<script>
    var baseUrl = $('meta[name=base-url]').attr("content");

    function Items({ id, name, created_at, updated_at, imagem, status, num_rifias}) {
        this.id = id;
        this.created_at = created_at;
        this.name = name;
        this.updated_at = updated_at
        this.imagem = baseUrl+"/assets/imagem/rifas/"+imagem
        this.number= num_rifias
        this.urlEdit = baseUrl+"/admin/rifas/items/"+this.id
        this.status = status == 1 ? "Ativado": "Desativado"
        this.class = status
    }
export default {

    data() {
        return {
            files: [],
            image:null,
            baselUrl:baseUrl,
            accept: 'image/png,image/jpeg,image/webp',
            extensions: 'jpg,jpeg,png,webp',
            minSize: 1024,
            size: 1024 * 1024 * 10,
            urlUpdate: null,
            showSucess: false,
            showError: false,
        }
    },

    computed: {},
    props:['user'],
    mounted() {

        var data = new Items(JSON.parse(this.user))
this.image = data.avatar


        this.urlUpdate = this.baselUrl+"/api/user/update-imagem/"+data.id
        console.log(this.urlUpdate)

    },
    methods: {
        remover: function(){
            var file = this.files[0]
            this.$refs.upload.remove(file)

        },
        inputFile: function (newFile, oldFile) {
            if (newFile && oldFile && !newFile.active && oldFile.active) {
                // Get response data

                console.error('response', newFile.response)
                if (newFile.xhr) {
                    //  Get the response status code
                    console.warn('status', newFile.xhr.status)
                    if(newFile.xhr.status == 200){
                        this.showSucess = true
                        this.showError = false
                    }else{
                        this.showSucess = false
                        this.showError = true
                    }
                }
            }
        },
        /**
         * Pretreatment
         * @param  Object|undefined   newFile   Read and write
         * @param  Object|undefined   oldFile   Read only
         * @param  Function           prevent   Prevent changing
         * @return undefined
         */
        inputFilter: function (newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Filter non-image file
                if (!/\.(jpeg|jpe|jpg|png|webp)$/i.test(newFile.name)) {
                    return prevent()
                }
            }

            // Create a blob field
            newFile.blob = ''
            let URL = window.URL || window.webkitURL
            if (URL && URL.createObjectURL) {
                newFile.blob = URL.createObjectURL(newFile.file)
            }
        }
    }

}
</script>