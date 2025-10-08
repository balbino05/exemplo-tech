import { boot } from 'quasar/wrappers'
import { ApolloClient, InMemoryCache, createHttpLink } from '@apollo/client/core'
import { DefaultApolloClient } from '@vue/apollo-composable'

export default boot(({ app }) => {
  const httpLink = createHttpLink({
    uri: 'http://127.0.0.1:8000/graphql',
  })

  const apolloClient = new ApolloClient({
    link: httpLink,
    cache: new InMemoryCache(),
  })

  app.provide(DefaultApolloClient, apolloClient)
})
