<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="exSlide01.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <h1>Inicio</h1>


        </div>
        <div>
            <asp:HyperLink ID="HyperLink3" runat="server" NavigateUrl="~/inicio.aspx">Inicio</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink1" runat="server" NavigateUrl="~/abastecer.aspx">Abastecer</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink2" runat="server" NavigateUrl="~/moedas.aspx">Moedas</asp:HyperLink>
        </div>
    </form>
</body>
</html>
