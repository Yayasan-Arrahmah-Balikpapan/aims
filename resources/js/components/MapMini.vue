<template>
  <div>
    <div ref="mapContainer" class="map-container"></div>
  </div>
</template>

<script>
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet.fullscreen';

export default {
  name: 'SafeLeafletMap',
  props: {
    latitude: {
      type: [Number, String],
      default: null
    },
    longitude: {
      type: [Number, String],
      default: null
    },
    zoom: {
      type: Number,
      default: 16
    },
    markerLabel: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      map: null,
      marker: null,
      label: null,
      defaultMarker: null
    };
  },
  computed: {
    hasValidCoordinates() {
      return !isNaN(this.parsedCoordinates.lat) &&
             !isNaN(this.parsedCoordinates.lng);
    },
    parsedCoordinates() {
      return {
        lat: this.parseCoordinate(this.latitude),
        lng: this.parseCoordinate(this.longitude)
      };
    },
    defaultLocation() {
      return {
        lat: -1.2246756,
        lng: 116.8810419,
        label: 'Masjid Arrahmah'
      };
    }
  },
  mounted() {
    this.initMap();
    this.addDefaultMarker();
    if (this.hasValidCoordinates) {
      this.addMarkerWithLabel();
    }
  },
  beforeDestroy() {
    if (this.map) {
      this.map.remove();
    }
  },
  watch: {
    parsedCoordinates(newVal) {
      if (this.map && this.hasValidCoordinates) {
        this.updateMarkerAndLabel(newVal);
      } else if (this.map) {
        this.clearMarker();
      }
    },
    markerLabel(newVal) {
      if (this.label && this.hasValidCoordinates) {
        this.updateLabelText(newVal);
      }
    }
  },
  methods: {
    initMap() {
      // Set view ke default location (Masjid Arrahmah)
      this.map = L.map(this.$refs.mapContainer, {
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft'
                }
            }).setView(
        [this.defaultLocation.lat, this.defaultLocation.lng],
        this.zoom
      );

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(this.map);
    },
    parseCoordinate(coord) {
      if (coord === null || coord === undefined || coord === '') return NaN;
      if (typeof coord === 'string') {
        const cleaned = coord.replace(/[^\d.-]/g, '');
        return parseFloat(cleaned);
      }
      return Number(coord);
    },
    addDefaultMarker() {
      // Buat marker merah untuk lokasi default
      const redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      this.defaultMarker = L.marker(
        [this.defaultLocation.lat, this.defaultLocation.lng],
        { icon: redIcon }
      ).addTo(this.map);

      // Tambahkan label untuk marker default
      L.marker([this.defaultLocation.lat, this.defaultLocation.lng], {
        icon: L.divIcon({
          className: 'default-map-label',
          html: `<div>${this.defaultLocation.label}</div>`,
          iconSize: [120, 20],
          iconAnchor: [60, 10]
        }),
        zIndexOffset: 1000,
        interactive: false
      }).addTo(this.map);
    },
    addMarkerWithLabel() {
      // Add main marker
      this.marker = L.marker([
        this.parsedCoordinates.lat,
        this.parsedCoordinates.lng
      ]).addTo(this.map);

      // Add label if markerLabel provided
      if (this.markerLabel) {
        this.label = L.marker([
          this.parsedCoordinates.lat,
          this.parsedCoordinates.lng
        ], {
          icon: L.divIcon({
            className: 'map-label',
            html: `<div>${this.markerLabel}</div>`,
            iconSize: [100, 20],
            iconAnchor: [50, 10]
          }),
          zIndexOffset: 1000,
          interactive: false
        }).addTo(this.map);

        // Adjust label position
        this.label.setLatLng([
          this.parsedCoordinates.lat - 0.0002,
          this.parsedCoordinates.lng
        ]);
      }

      // Fit bounds untuk menampilkan kedua marker jika ada
      if (this.marker && this.defaultMarker) {
        const group = new L.featureGroup([this.marker, this.defaultMarker]);
        this.map.fitBounds(group.getBounds().pad(0.2));
      }
    },
    updateMarkerAndLabel(newCoords) {
      if (this.marker) {
        this.marker.setLatLng([newCoords.lat, newCoords.lng]);
      } else {
        this.addMarkerWithLabel();
      }

      if (this.label) {
        this.label.setLatLng([newCoords.lat - 0.0002, newCoords.lng]);
      }

      // Update view untuk menampilkan kedua marker
      if (this.marker && this.defaultMarker) {
        const group = new L.featureGroup([this.marker, this.defaultMarker]);
        this.map.fitBounds(group.getBounds().pad(0.2));
      }
    },
    updateLabelText(text) {
      if (this.label) {
        this.label.setIcon(L.divIcon({
          className: 'map-label',
          html: `<div>${text}</div>`,
          iconSize: [100, 20],
          iconAnchor: [50, 10]
        }));
      }
    },
    clearMarker() {
      if (this.marker) {
        this.map.removeLayer(this.marker);
        this.marker = null;
      }
      if (this.label) {
        this.map.removeLayer(this.label);
        this.label = null;
      }
      // Kembalikan view ke default marker
      this.map.setView(
        [this.defaultLocation.lat, this.defaultLocation.lng],
        this.zoom
      );
    }
  }
};
</script>

<style scoped>
.map-container {
  height: 150px;
  width: 300px;
  margin-bottom: 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.no-coordinates {
  padding: 10px;
  text-align: center;
  background: #f8f9fa;
  border-radius: 4px;
  color: #6c757d;
  margin-top: 10px;
}

.coordinates {
  margin-top: 10px;
  font-family: monospace;
  text-align: center;
  color: #555;
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

/* Style untuk label default */
:deep(.default-map-label) {
  background: transparent;
  border: none;
}

:deep(.default-map-label div) {
  background: #ffebee;
  padding: 2px 8px;
  border-radius: 3px;
  border: 1px solid #ef9a9a;
  box-shadow: 0 1px 3px rgba(0,0,0,0.2);
  font-size: 12px;
  font-weight: bold;
  color: #c62828;
  white-space: nowrap;
  transform: translateX(-50%);
}
</style>
