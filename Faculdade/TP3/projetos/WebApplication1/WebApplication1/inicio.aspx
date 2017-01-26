<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="WebApplication1.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Inicio</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
    
        <asp:HyperLink ID="HyperLink1" runat="server" ImageHeight="40px" NavigateUrl="~/abastecer.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/07-postos_icon.png">Abastecer</asp:HyperLink>
        &nbsp
        <asp:HyperLink ID="HyperLink2" runat="server" ImageHeight="40px" NavigateUrl="~/conversao.aspx" ImageWidiht="40px" ImageUrl="~/Imagens/moedas-ouro-dinheiro.png">Conversão</asp:HyperLink>
        

    </div>
    </form>
</body>
</html>
