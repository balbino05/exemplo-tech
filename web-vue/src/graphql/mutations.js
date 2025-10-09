import gql from 'graphql-tag'

// ✅ Corrigido: agora acessa produtos dentro de "data"
export const GET_PRODUCTS = gql`
query GetProducts($limit: Int, $page: Int) {
  products(limit: $limit, page: $page) {
    data {
      id
      name
      description
      price
      stock
    }
    paginatorInfo {
      total
      currentPage
      lastPage
    }
  }
}
`

export const CREATE_PRODUCT = gql`
mutation($name: String!, $description: String!, $price: Float!, $stock: Int!) {
  createProduct(name: $name, description: $description, price: $price, stock: $stock) {
    id
    name
    description
    price
    stock
  }
}
`

export const UPDATE_PRODUCT = gql`
mutation($id: ID!, $name: String!, $description: String!, $price: Float!, $stock: Int!) {
  updateProduct(id: $id, name: $name, description: $description, price: $price, stock: $stock) {
    id
    name
    description
    price
    stock
  }
}
`

export const DELETE_PRODUCT = gql`
mutation($id: ID!) {
  deleteProduct(id: $id)
}
`

export const LOGIN_MUTATION = gql`
mutation Login($email: String!, $password: String!) {
  login(email: $email, password: $password) {
    access_token
    user {
      id
      name
      email
    }
  }
}
`
