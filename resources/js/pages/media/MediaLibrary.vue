<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="title-header option-title justify-content-start">
            <h5>Media Library</h5>
            <div class="selected-options">
              <ul>
                <li>selected({{ selectedMedia.length }})</li>
                <li v-if="selectedMedia.length > 0">
                  <a href="#" @click="downloadImages">
                    <i class="ri-download-2-line"></i>
                  </a>
                </li>
                <li v-if="selectedMedia.length > 0">
                  <a href="#" @click="deleteImages">
                    <i class="ri-delete-bin-line"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div
            class="row row-cols-xl-6 row-cols-md-5 row-cols-sm-3 row-cols-2 g-sm-3 g-2 media-library-sec ratio_square">

            <MediaItem v-for="(item, index) in mediaItems" :key="index" :image="item.path" :folder="item.folder"
              :id="`${index}${item.time}`"
              :isSelected="selectedMedia.some(selected => selected.id === `${index}${item.time}`)"
              @update-selection="updateSelectedMedia"
              @delete-image="deleteSingleImage"
              @download-image="downloadSingleImage" />
          </div>

          <Pagination :currentPage="currentPage" :totalPages="totalPages" @page-change="handlePageChange" />

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import MediaItem from './MediaItem.vue';
import Pagination from '../../components/Pagination.vue';

export default {
  name: 'MediaLibrary',
  components: {
    MediaItem,
    Pagination
  },
  data() {
    return {
      mediaItems: [],
      selectedMedia: [],
      selectedMedia: [],
      perPage: 30,
      currentPage: 1,
      totalPages: 1
    };
  },
  methods: {
    async fetchMedia(page = 1) {
      const response = await axios.get('/admin/get-media', {
        params: {
          page,
          per_page: this.perPage
        }
      });

      if (response.data && response.data.success) {
        this.mediaItems = response.data.images;
        this.totalPages = response.data.meta.last_page || 1;
        this.currentPage = page;
      }
    },
    updateSelectedMedia({ id, selected, image, folder }) {
      if (selected) {
        // If selected and not already in the list, add it
        if (!this.selectedMedia.some(selectedId => selectedId.id === id)) {
          this.selectedMedia.push({ id, url: image, folder });
        }
      } else {
        // If not selected, filter out the item based on the ID
        this.selectedMedia = this.selectedMedia.filter(selectedId => selectedId.id !== id);
      }
    },
    async downloadSingleImage(imageUrl) {
      const response = await fetch(imageUrl);
      const blob = await response.blob();
      const normalizedUrl = imageUrl.replace(/\\/g, '/');
      const imageName = normalizedUrl.split('/').pop();

      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = imageName;
      document.body.appendChild(a);
      a.click();
      a.remove();
      window.URL.revokeObjectURL(url);
    },
    async downloadImages() {
      if (this.selectedMedia.length === 1) {
        await this.downloadSingleImage(this.selectedMedia[0].url);
        this.selectedMedia = [];
      } else {
        const zip = new JSZip();
        const promises = this.selectedMedia.map(async (image) => {
          const response = await fetch(image.url);
          const blob = await response.blob();
          const normalizedUrl = image.url.replace(/\\/g, '/');
          const imageName = normalizedUrl.split('/').pop();
          zip.file(imageName, blob);
        });

        await Promise.all(promises);

        const content = await zip.generateAsync({ type: 'blob' });
        saveAs(content, 'images.zip');

        this.selectedMedia = [];
      }
    },
    async deleteImage(imagesToDelete){
      try {
        const response = await axios.delete('/admin/media/delete', {
          data: {
            images: imagesToDelete
          }
        });

        if (response.data.success) {
          this.selectedMedia = [];
          await this.fetchMedia(this.currentPage);
          alert('Images deleted successfully.');
        } else {
          alert('Failed to delete images. Please try again.');
        }
      } catch (error) {
        console.error('Error deleting images:', error);
        alert('An error occurred while deleting images. Please try again.');
      }
    },
    async deleteSingleImage(selectedImage){
      this.deleteImage(selectedImage);
    },
    async deleteImages() {
      const confirmed = confirm('Are you sure you want to delete the selected images?');
      if (!confirmed) return;
      
      const imagesToDelete = this.selectedMedia.map(media => ({
        url: media.url,
        folder: media.folder
      }));

      this.deleteImage(imagesToDelete);
    },
    handlePageChange(page) {
      if (page < 1 || page > this.totalPages) return;
      this.fetchMedia(page);
    }
  },
  created() {
    this.fetchMedia();
  }
};
</script>

<style scoped>
/* Add your styles here */
</style>