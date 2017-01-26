<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="home.aspx.cs" Inherits="aula13_08.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Home</title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <asp:HyperLink ID="home" runat="server" NavigateUrl="~/home.aspx">Home</asp:HyperLink>
            <br />
            <asp:HyperLink ID="sobre" runat="server" NavigateUrl="~/sobre.aspx">About</asp:HyperLink>
            <br />
            <br />
            <h1>Pagina Inicial</h1>


        </div>
        <div>
            <asp:DropDownList ID="ddlTime" runat="server" AutoPostBack="True" Height="16px" OnSelectedIndexChanged="DropDownList1_SelectedIndexChanged" Width="236px">
                <asp:ListItem>Corinthians</asp:ListItem>
                <asp:ListItem>São Paulo</asp:ListItem>
                <asp:ListItem>Flamengo</asp:ListItem>
                <asp:ListItem>Atlético</asp:ListItem>
            </asp:DropDownList>
            <asp:Label ID="lbTime" runat="server" Text="Label"></asp:Label>
        </div>
    </form>
</body>
</html>
