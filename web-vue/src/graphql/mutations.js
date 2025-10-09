import gql from 'graphql-tag'

export const GET_PRODUCTS = gql`
query {
  products {
    id
    name
    description
    price
    stock
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

