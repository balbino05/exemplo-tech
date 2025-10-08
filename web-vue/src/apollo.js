import { ApolloClient, InMemoryCache, HttpLink } from '@apollo/client/core'

const httpLink = new HttpLink({
   uri: 'http://127.0.0.1:8000/graphql',
})

export default new ApolloClient({
   link: httpLink,
   cache: new InMemoryCache(),
})
