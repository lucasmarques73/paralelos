<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PaginaRestrita.aspx.cs" Inherits="ExemploSessao.PaginaRestrita" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <h1>Página Restrita: Somente usuários autorizados</h1>
            <br />
            <asp:Label ID="lblUsuario" runat="server" Text="..."></asp:Label>
            <br />
            <asp:LinkButton ID="btnSair" runat="server" OnClick="btnSair_Click">Sair</asp:LinkButton>       
        </div>
    </form>
</body>
</html>
