<template>
  <div class="mt-5">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Firma</th>
          <th>Produkte</th>
          <th>Aktionen</th>
        </tr>
      </thead>

      <tbody>
        <template v-for="company in companies" :key="company.id">
            <company-table-row :company="company"></company-table-row>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import CompanyTableRow from "./CompanyTableRow";

export default {
  name: "CompanyTableView",
  props: {
    companies: {
      type: Array,
      required: true,
    },
  },
  components: {
    CompanyTableRow,
  },
};
</script>

<style></style>
