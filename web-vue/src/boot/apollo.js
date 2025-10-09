import { boot } from 'quasar/wrappers'
import { ApolloClient, createHttpLink, InMemoryCache } from '@apollo/client/core'
import { setContext } from '@apollo/client/link/context'
import { DefaultApolloClient } from '@vue/apollo-composable'

export default boot(({ app }) => {
  const httpLink = createHttpLink({
    uri: 'http://127.0.0.1:8000/graphql',
  })

  const authLink = setContext((_, { headers }) => {
    const token = localStorage.getItem('token')
    return {
      headers: {
        ...headers,
        authorization: token ? `Bearer ${token}` : '',
      },
    }
  })

  const apolloClient = new ApolloClient({
    link: authLink.concat(httpLink),
    cache: new InMemoryCache(),
  })

  app.provide(DefaultApolloClient, apolloClient)
})
