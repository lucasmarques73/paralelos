<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="sobre.aspx.cs" Inherits="aula13_08.about" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>About</title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <asp:HyperLink ID="home" runat="server" NavigateUrl="~/home.aspx">Home</asp:HyperLink>
            <br />
            <asp:HyperLink ID="sobre" runat="server" NavigateUrl="~/sobre.aspx">About</asp:HyperLink>
            <br />
            <br />
            <h1>Pagina de Sobre</h1>
        </div>

    </form>
</body>
</html>
