<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="aula10_09.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <h1>Pagina Inicial</h1>
        <br />
        <asp:Label ID="Label1" runat="server" Text="Digite o Usuario"></asp:Label>
        <asp:TextBox ID="txtUsuario" runat="server"></asp:TextBox>
        <asp:Button ID="Button1" runat="server" Text="Validar" OnClick="Button1_Click" />
        <br />
        <asp:Label ID="lbMensagem" runat="server" Text=""></asp:Label>
    </div>
    </form>
</body>
</html>
