<template>
  <div>
    <div ref="mapContainer" class="map-container"></div>
    <div v-if="filteredLocations.length === 0" class="no-locations">
      Tidak ada lokasi yang valid untuk ditampilkan
    </div>
  </div>
</template>

<script>
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default {
  name: 'NullSafeMap',
  props: {
    locations: {
      type: Array,
      required: true,
      validator: value => value.every(item => item.name)
    },
    zoom: {
      type: Number,
      default: 16
    }
  },
  data() {
    return {
      map: null,
      markers: [],
      labels: []
    };
  },
  computed: {
    filteredLocations() {
      return this.locations.filter(location => {
        const lat = this.parseCoordinate(location.latitude);
        const lng = this.parseCoordinate(location.longitude);
        return !isNaN(lat) && !isNaN(lng) && location.latitude !== null && location.longitude !== null;
      });
    }
  },
  mounted() {
    this.initMap();
    this.plotMarkersWithLabels();
  },
  beforeDestroy() {
    if (this.map) {
      this.map.remove();
    }
  },
  watch: {
    locations: {
      handler() {
        if (this.map) {
          this.clearMarkers();
          this.plotMarkersWithLabels();
        }
      },
      deep: true
    }
  },
  methods: {
    initMap() {
      const defaultCenter = [-1.2246756,116.8810419];
      const center = this.filteredLocations.length > 0 ?
        this.calculateCenter() :
        defaultCenter;

      this.map = L.map(this.$refs.mapContainer).setView(center, this.zoom);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(this.map);
    },
    parseCoordinate(coord) {
      if (coord === null || coord === undefined) return NaN;
      if (typeof coord === 'string') {
        const cleaned = coord.replace(/[^\d.-]/g, '');
        return parseFloat(cleaned);
      }
      return Number(coord);
    },
    plotMarkersWithLabels() {
      this.filteredLocations.forEach(location => {
        const lat = this.parseCoordinate(location.latitude);
        const lng = this.parseCoordinate(location.longitude);

        // Buat marker
        const marker = L.marker([lat, lng]).addTo(this.map);

        // Buat label
        const label = L.marker([lat, lng], {
          icon: L.divIcon({
            className: 'map-label',
            html: `<div>${location.name}</div>`,
            iconSize: [100, 20],
            iconAnchor: [50, 10]
          }),
          zIndexOffset: 1000,
          interactive: false
        }).addTo(this.map);

        // Sesuaikan posisi label
        label.setLatLng([lat - 0.00002, lng]);

        this.markers.push(marker);
        this.labels.push(label);
      });

      // Fit bounds jika ada marker yang valid
      if (this.filteredLocations.length > 0) {
        const group = new L.featureGroup(this.markers);
        this.map.fitBounds(group.getBounds().pad(0.1));
      }
    },
    clearMarkers() {
      this.markers.forEach(marker => this.map.removeLayer(marker));
      this.labels.forEach(label => this.map.removeLayer(label));
      this.markers = [];
      this.labels = [];
    },
    calculateCenter() {
      const latSum = this.filteredLocations.reduce((sum, loc) =>
        sum + this.parseCoordinate(loc.latitude), 0);
      const lngSum = this.filteredLocations.reduce((sum, loc) =>
        sum + this.parseCoordinate(loc.longitude), 0);

      return [
        latSum / this.filteredLocations.length,
        lngSum / this.filteredLocations.length
      ];
    }
  }
};
</script>

<style scoped>
.map-container {
  height: 500px;
  width: 100%;
  margin-bottom: 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.no-locations {
  padding: 20px;
  text-align: center;
  background: #f8f9fa;
  border-radius: 4px;
  color: #6c757d;
}

/* Style untuk label */
:deep(.map-label) {
  background: transparent;
  border: none;
}

:deep(.map-label div) {
  background: white;
  padding: 2px 8px;
  border-radius: 3px;
  border: 1px solid #ccc;
  box-shadow: 0 1px 3px rgba(0,0,0,0.2);
  font-size: 12px;
  font-weight: bold;
  color: #333;
  white-space: nowrap;
  transform: translateX(-50%);
}
</style>
