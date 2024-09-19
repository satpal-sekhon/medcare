<template>
    <div>
        <div class="library-box">
            <input type="checkbox" :id="`myCheckbox-${id}`" @change="onCheckboxChange" :checked="isSelected" />
            <label :for="`myCheckbox-${id}`">
                <div>
                    <img :src="image" class="img-fluid bg-img bg_size_content" alt="">
                </div>
                <div class="dropdown">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ri-more-fill"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" @click="downloadImage">
                                <i class="ri-download-2-line me-2"></i>
                                Download
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="ri-delete-bin-line me-2"></i>
                                Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MediaItem',
    props: {
        image: {
            type: String,
            required: true,
        },
        id: {
            type: [Number, String],
            required: true,
        },
        isSelected: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        onCheckboxChange(event) {
            this.$emit('update-selection', {
                id: this.id,
                selected: event.target.checked,
                image: this.image
            });
        },
        downloadImage(){
            this.$emit('download-image', this.image);
        }
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>