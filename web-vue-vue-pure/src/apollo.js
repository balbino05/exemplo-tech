import { boot } from 'quasar/wrappers'
import { ApolloClient, InMemoryCache, HttpLink } from '@apollo/client/core'
import { DefaultApolloClient } from '@vue/apollo-composable'

const httpLink = new HttpLink({
   uri: 'http://127.0.0.1:8000/graphql', // Laravel backend
})

const apolloClient = new ApolloClient({
   link: httpLink,
   cache: new InMemoryCache(),
})

export default boot(({ app }) => {
   app.provide(DefaultApolloClient, apolloClient)
})

export { apolloClient }
