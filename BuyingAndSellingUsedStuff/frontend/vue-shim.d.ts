// vue-shim.d.ts
// Composition-API 사용할 때
declare module '*.vue' {
  import Vue from 'vue'
  import { defineComponent } from '@nuxtjs/composition-api'
  export const Component: ReturnType<typeof defineComponent>
  export default Vue
}
