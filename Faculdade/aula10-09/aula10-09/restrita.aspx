<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="restrita.aspx.cs" Inherits="aula10_09.restrita" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <h1>Pagina Restrita</h1>
        <h2>Somente usuarios autorizados</h2>
        <br />
        <asp:Label ID="lbUsuario" runat="server" Text=""></asp:Label>
        <br />
        <asp:LinkButton ID="btSair" runat="server" OnClick="btSair_Click">Sair</asp:LinkButton>
    
    </div>
    </form>
</body>
</html>
