<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="aula03_09.inicio1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <asp:Label ID="Label1" runat="server" Text="Digite Seu Time: "></asp:Label>
        <asp:TextBox ID="txtTime" runat="server"></asp:TextBox>
        <asp:Button ID="btOk" runat="server" Text="Ok" OnClick="btOk_Click" style="height: 26px" />
    </div>
    </form>
</body>
</html>
