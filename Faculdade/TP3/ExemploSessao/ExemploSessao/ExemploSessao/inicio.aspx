<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="ExemploSessao.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <h1>Página Inicial do Sistema</h1>
        <br />
        <asp:Label ID="Label1" runat="server" Text="Digite o nome do usuário"></asp:Label>
        <asp:TextBox ID="txtUsuario" runat="server"></asp:TextBox>
        <asp:Button ID="btnValidar" runat="server" Text="Validar" OnClick="btnValidar_Click" />
        <br />
        <asp:Label ID="lblMensagem" runat="server" Text="..."></asp:Label>
    </div>
    </form>
</body>
</html>
