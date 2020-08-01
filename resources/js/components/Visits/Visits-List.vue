<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-block">
            <h3 style="float:left;">Types des visites</h3>
          </div>
          <div class="card-body p-0 table-border-style">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>tva</th>
                    <th>narfa</th>
                    <th>kitonse</th>
                    <th>local</th>
                    <th>total</th>
                    <th class="nosort"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="visit in getVisits" :key="visit.id">
                    <th scope="row">{{ visit.id }}</th>
                    <td>{{ visit.type }}</td>
                    <td>{{ visit.price }} DH</td>
                    <td>{{ visit.tva }} DH</td>
                    <td>{{ visit.narfa }} DH</td>
                    <td>{{ visit.kitonse }} DH</td>
                    <td>{{ visit.local }} DH</td>
                    <td>
                      <b>{{ visit.total }} DH</b>
                    </td>
                    <td>
                      <a
                        style="cursor: pointer; font-size:15px;"
                        @click="edit(customer)"
                        data-toggle="modal"
                        data-target="#editVisitModal"
                      >
                        <i class="ik ik-edit-2 text-green"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch("visits");
  },
  computed: {
    getVisits() {
      return this.$store.getters.getVisits;
    },
  },
};
</script>
