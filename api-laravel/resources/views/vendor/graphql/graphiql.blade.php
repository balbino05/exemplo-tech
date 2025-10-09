<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>GraphiQL</title>
   <link rel="stylesheet" href="{{ asset('graphiql/graphiql.min.css') }}">
</head>

<body style="margin: 0;">
   <div id="graphiql" style="height: 100vh;"></div>

   <script src="{{ asset('graphiql/react.production.min.js') }}"></script>
   <script src="{{ asset('graphiql/react-dom.production.min.js') }}"></script>
   <script src="{{ asset('graphiql/graphiql.min.js') }}"></script>

   <script>
      const graphQLFetcher = graphQLParams =>
         fetch('/graphql', {
            method: 'post',
            headers: {
               'Content-Type': 'application/json',
               'Accept': 'application/json',
               // descomente abaixo se quiser testar JWT direto no GraphiQL
               // 'Authorization': 'Bearer <seu_token_aqui>',
            },
            body: JSON.stringify(graphQLParams),
         })
         .then(response => response.json())
         .catch(error => {
            console.error(error);
         });

      ReactDOM.render(
         React.createElement(GraphiQL, {
            fetcher: graphQLFetcher
         }),
         document.getElementById('graphiql')
      );
   </script>
</body>

</html>
