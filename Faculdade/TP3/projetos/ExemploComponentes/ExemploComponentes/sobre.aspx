<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="sobre.aspx.cs" Inherits="ExemploComponentes.sobre" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Sobre</title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <asp:HyperLink ID="HyperLink1" runat="server" ImageHeight="40px" ImageUrl="~/imagens/inicio.jpg" ImageWidth="40px" NavigateUrl="~/inicio.aspx">Início</asp:HyperLink>
            <asp:HyperLink ID="HyperLink2" runat="server" ImageHeight="40px" ImageUrl="~/imagens/sobre.jpg" ImageWidth="40px" NavigateUrl="~/sobre.aspx">Sobre</asp:HyperLink>
            <br />
            <br />
            <h1>Página Sobre...</h1>

        </div>
    </form>
</body>
</html>
